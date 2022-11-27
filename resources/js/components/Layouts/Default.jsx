import React from 'react';
import { Sidbar } from '../Sidbar';

const Layout =({children}) =>{
    return(
        <>
        <div className='min-h-full'>
            <Sidbar/>
            {children}
        </div>

        </>
    )
}

export default Layout;
