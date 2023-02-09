import React from 'react'
import TreeView from '../../components/user/tree/TreeView';

const BinaryTree = () => {
    const [userName, setUserName] = React.useState();


  return (
        <div className="tree-screen">
            <div className='w-full flex justify-center items-center rounded-md border-1 border-gray-500 py-[20px]'>
                <input type="text" value={userName} onChange={(e) => setUserName(e.target.value)} placeholder={"Search by username"}
                className="w-64 h-12 mx-auto rounded-[60px] border-2 placeholder:text-left outline-none p-5"
                />
            </div>

            <TreeView username={userName} />
        </div>
  )
}

export default BinaryTree;
