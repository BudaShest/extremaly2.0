import React, {useState, useEffect} from 'react';
import style from './Person.module.css';

const Person = ({person,index, isActive, clickHandler, order}) => {
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
            <div data-number={index} onClick={clickHandler} className={className} style={{backgroundImage:`url(${person.images[0]})`, order:order}}>
                <div style={{fontSize:'44px', color:'red'}}></div>
            </div>

    );
};

export default Person;