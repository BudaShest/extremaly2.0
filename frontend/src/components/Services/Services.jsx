import React,{useState} from 'react';
import {Row, Card} from 'react-materialize';
import Service from "../Service/Service";

const Services = () => {
    const [services, setServices] = useState([
        {id:1, s:12, l: 5, is_horizontal:false, size:"large", title:"Заселитесь в Оверлук!", image:"https://avatars.mds.yandex.net/get-zen_doc/1790220/pub_5dc463c6028d6800b025b86c_5dc4714498fe7900aeecf628/scale_1200", description: "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat molestias nesciunt officiis possimus qui, quo quod sapiente velit veritatis! Ab consectetur ipsam modi."},
        {id:2, s:12, l: 7, is_horizontal:true, size:"small", title:"Поход на Эльбрус", image:"https://b1.vpoxod.ru/route/fe/33/91206_350x280.jpg", description: "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat molestias nesciunt officiis possimus qui, quo quod sapiente velit veritatis! Ab consectetur ipsam modi."},
        {id:3, s:12, l: 7, is_horizontal:true,size:"small", title:"Погружение на дно Карбиского моря!", image:"http://skalsa.ru/images/bt_property/91/3.jpg", description: "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat molestias nesciunt officiis possimus qui, quo quod sapiente velit veritatis! Ab consectetur ipsam modi."},
    ])


    return (
        <Row style={{margin:0}}>
            {
                services.map(service=><Service key={service.id} {...service}/>)
            }
        </Row>
    );
};

export default Services;