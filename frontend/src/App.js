import '../node_modules/materialize-css/dist/css/materialize.min.css';
import '../node_modules/materialize-css/dist/js/materialize.min';
import './App.css';
import {Preloader} from "react-materialize";
import React,{Suspense} from 'react';
import {BrowserRouter as Router} from 'react-router-dom';

// import Header from './components/Header/Header';
// import Footer from "./components/Footer/Footer";
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
