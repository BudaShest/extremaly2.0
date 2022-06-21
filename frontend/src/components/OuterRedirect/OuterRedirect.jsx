import React, {useEffect} from 'react';

const OuterRedirect = () => {

    useEffect(()=>{
        window.location = 'http://185.182.111.121:8000/admin/main/login';
    }, [])

    return (
        <div>

        </div>
    );
};

export default OuterRedirect;