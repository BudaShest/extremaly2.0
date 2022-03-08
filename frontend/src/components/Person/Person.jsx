import React, {useState, useEffect} from 'react';
import style from './Person.module.css';
import {Col} from 'react-materialize';



const Person = ({id,avatar, clickHandler, isActive,order}) => {

    const [className, setClassName] = useState(`${style.person} hoverable`);


    useEffect(()=>{
        if(isActive){
            let newClassName = className + " " + style.personActive;
            setClassName(newClassName)

        }else{
            setClassName(`${style.person} hoverable`);
        }
    },[isActive])


    return (
            <div data-id={id} onClick={clickHandler} className={className} style={{backgroundImage:`url(/img/${avatar})`, order:order}}>
                <div style={{fontSize:'44px', color:'red'}}>{order}</div>
            </div>

    );
};

export default Person;