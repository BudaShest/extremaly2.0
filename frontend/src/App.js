import '../node_modules/materialize-css/dist/css/materialize.min.css';
import '../node_modules/materialize-css/dist/js/materialize.min';
import './App.css';
import {Preloader} from "react-materialize";
import React,{Suspense, useEffect} from 'react';
import {BrowserRouter as Router} from 'react-router-dom';
import {useDispatch, useSelector} from 'react-redux';
import {fetchCountries} from "./asyncActions/places/fetchCountries";
import MainRouter from "./router/MainRouter";


const Header = React.lazy(()=>import('./components/Header/Header'));
const Footer = React.lazy(()=>import('./components/Footer/Footer'));

function App() {
  return (
    <Router>
        <Suspense fallback={<Preloader/>}>
            <Header/>
        </Suspense>
            <MainRouter/>
        <Suspense fallback={<Preloader/>}>
            <Footer/>
        </Suspense>

    </Router>

  );
}

export default App;
