import React, {useEffect} from 'react';

const OuterRedirect = () => {

    useEffect(()=>{
        window.location = 'http://extremly.ru:8000/admin/main/login';
    }, [])

    return (
        <div>

        </div>
    );
};

export default OuterRedirect;