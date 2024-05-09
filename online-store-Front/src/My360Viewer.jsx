import React, { useState } from 'react';
import ThreeSixty from "react-360-view";

const ThreeSixty = ({ images }) => {
  const [currentImageIndex, setCurrentImageIndex] = useState(0);

  const nextImage = () => {
    setCurrentImageIndex((prevIndex) => (prevIndex + 1) % images.length);
  };

  const previousImage = () => {
    setCurrentImageIndex((prevIndex) => (prevIndex - 1 + images.length) % images.length);
  };

  return (
    <div className="threesixty-container">
      <img src={images[currentImageIndex]} alt={`Image ${currentImageIndex}`} />
      <button onClick={previousImage}>Previous</button>
      <button onClick={nextImage}>Next</button>
    </div>
  );
};

export default ThreeSixty;
