import React from 'react';
import '../../style/Loader.css';

const Loader = () => {
  return (
    <div className='loaderContainer'>
        <div className="pinwheel">
            <div className="pinwheel__line"></div>
            <div className="pinwheel__line"></div>
            <div className="pinwheel__line"></div>
            <div className="pinwheel__line"></div>
            <div className="pinwheel__line"></div>
            <div className="pinwheel__line"></div>
        </div>
    </div>
  );
};

export default Loader;