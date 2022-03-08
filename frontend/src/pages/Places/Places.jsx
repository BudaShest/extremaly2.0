import React, {useEffect} from 'react';
import {Container} from 'react-materialize';

const Places = () => {

    useEffect(()=>{
        const script = document.createElement('script');
        script.src = "https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A06a5bc8124e28a3155582c309a0319fdca6a0d1a807d8a73e2880b0a30a015e3&amp;width=100%25&amp;height=600&amp;lang=ru_RU&amp;scroll=true";
        script.charSet = "utf-8";
        script.async = true;

        document.querySelector('#mapContainer').append(script);
    },[])

    return (
        <main>
            <div id="mapContainer">

            </div>
            <Container>

            </Container>
        </main>
    );
};

export default Places;