import React from 'react';
import {Footer as FooterM} from "react-materialize";

const Footer = () => {
    return (
        <FooterM
            copyrights={`©Extremly 2020-${new Date().getFullYear()}`}
            links={<ul><li><a className="grey-text text-lighten-3" href="#!">Места</a></li><li><a className="grey-text text-lighten-3" href="/events">События</a></li><li><a className="grey-text text-lighten-3" href="#!">Личности</a></li></ul>}
            moreLinks={<a className="grey-text text-lighten-4 right" href="#!">Сайт разработчиков</a>}
        >
            <h5 className="white-text">
                Остались вопросы? Так просто свяжитесь с нами!
            </h5>
            <p className="grey-text text-lighten-4">
                г. Москва, ул. Литейный проспект, д. 157 <br/>
                {/*<a href=""></a> <br/>*/}
                {/*<a href=""></a> <br/>*/}
            </p>
        </FooterM>
    );
};

export default Footer;