import React from 'react';
import {Navbar, Icon, NavItem, Row, Button, Col} from 'react-materialize';
import style from './header.module.css';
import {NavLink} from 'react-router-dom';

const Header = () => {
    return (
        <header>
            <Navbar
                className={style.navbar}
                alignLinks="right"
                brand={
                    <a className={style.logo} href="/"><Row>
                        <Col className={`s4`}>
                            <img className="responsive-img" src="/img/logo.png" alt=""/>
                        </Col>
                        <Col className={`s8`}>
                            <span className={`${style.logoSpan} row`}>Extremly</span>
                            <span className={`${style.logoText} row`}>Эсктримальный и нестандартный отдых</span>
                        </Col>
                    </Row></a>
                }
                id="mobile-nav"
                menuIcon={<Icon>menu</Icon>}
                options={{
                    draggable:true,
                    edge: 'left',
                    inDuration:250,
                    onCloseEnd: null,
                    onCloseStart: null,
                    onOpenEnd: null,
                    onOpenStart: null,
                    outDuration:200,
                    preventScroll:true
                }}
            >
                <NavItem>
                    <NavLink to="/places">Места</NavLink>
                </NavItem>
                <NavItem>
                    <NavLink to="/events">События</NavLink>
                </NavItem>
                <NavItem>
                    <NavLink to="/persons">Личности</NavLink>
                </NavItem>
                <NavItem>
                    <NavLink className={`${style.loginBtn} btn waves-effect waves-light`} to="/login">Войти</NavLink>
                </NavItem>
            </Navbar>
        </header>
    );
};

export default Header;