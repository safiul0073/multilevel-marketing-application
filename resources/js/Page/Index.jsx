import React from 'react';
import ReactDOM from 'react-dom/client';

function Index() {
    return (
        <div className="container">
            <h1 className="text-gray-400">hello world</h1>
        </div>
    );
}

export default Index;

if (document.getElementById('root')) {
    const rootId = ReactDOM.createRoot(document.getElementById("root"));

    rootId.render(
        <React.StrictMode>
            <Index/>
        </React.StrictMode>
    )
}
