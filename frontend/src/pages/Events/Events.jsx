import React from 'react';
import {Container} from 'react-materialize';
import Services from "../../components/Services/Services";
import Records from '../../components/Records/Records';

const Events = () => {
    const records = [
        {id:0,img:"https://placepic.ru/wp-content/uploads/2019/07/ushanov-15.jpg",description:"Не следует, однако забывать, что новая модель организационной деятельности требуют определения и уточнения существенных финансовых и административных условий. Идейные соображения высшего порядка, а также дальнейшее развитие различных форм деятельности...."},
        {id:1,img:"https://placepic.ru/wp-content/uploads/2019/07/ushanov-15.jpg",description:"Не следует, однако забывать, что новая модель организационной деятельности требуют определения и уточнения существенных финансовых и административных условий. Идейные соображения высшего порядка, а также дальнейшее развитие различных форм деятельности...."},
        {id:2,img:"https://placepic.ru/wp-content/uploads/2019/07/ushanov-15.jpg",description:"Не следует, однако забывать, что новая модель организационной деятельности требуют определения и уточнения существенных финансовых и административных условий. Идейные соображения высшего порядка, а также дальнейшее развитие различных форм деятельности...."},
        {id:3,img:"https://placepic.ru/wp-content/uploads/2019/07/ushanov-15.jpg",description:"Не следует, однако забывать, что новая модель организационной деятельности требуют определения и уточнения существенных финансовых и административных условий. Идейные соображения высшего порядка, а также дальнейшее развитие различных форм деятельности...."},
    ]


    return (
        <main style={{backgroundColor:"#222"}}>
            <Container>
                <h2 className="white-text" style={{margin:0,padding:30}}>Популярное</h2>
                <Services/>
                <h3 className="white-text" style={{padding:30}}>Все услуги</h3>
                <Records records={records}/>
            </Container>
        </main>
    );
};

export default Events;