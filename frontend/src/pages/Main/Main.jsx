import React from 'react';
import SectionSlider from "./SectionSlider";
import {Container, Parallax} from "react-materialize";
import SectionAbout from "./SectionAbout";
import Services from "../../components/Services/Services";
import MainSlider from "../../components/MainSlider/MainSlider";

const Main = () => {
    return (
        <>
            <MainSlider/>
            <SectionSlider/>
            <Parallax
                image={<img alt="" src="img/parallax/parallax_1.jpg"/>}
                options={{
                    responsiveThreshold: 0
                }}
            />
            <SectionAbout/>
            <Parallax
                image={<img alt="" src="img/parallax/parallax_2.jpg"/>}
                options={{
                    responsiveThreshold: 0
                }}
            />
            {/* TODO Вынести секцию */}
            <section style={{backgroundColor:"#222"}}>
                <Container>
                    <h2 className="white-text" style={{margin:0,padding:30}}>Популярное</h2>
                    <Services/>
                </Container>
            </section>
        </>
    );
};

export default Main;