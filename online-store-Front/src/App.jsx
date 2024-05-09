import { useState } from 'react';
import { RouterProvider } from 'react-router-dom';
import { router } from './router/index.jsx';
import FirstDataContext from './contexts/dataContext.jsx';

function App() {

  return (
    <>
      <FirstDataContext>
          <RouterProvider router={router} />     
      </FirstDataContext>
    </>
  )
}

export default App
