import React, { useEffect, lazy } from 'react'
import { useState } from 'react';
import { useMemo } from 'react';
import TreeNode from '../../components/user/tree/TreeNode';
import { binaryTreeData } from '../../hooks/queries/user/binaryTreeData';

const BinaryTree = () => {
    const [userName, setUserName] = useState();
    // fetching binary tree user data
    const { data:treeDatas, isLoading, refetch } = binaryTreeData({username:userName});
    // finding root user
    const root = useMemo(() => {for (let i = 0; i<treeDatas?.length; i++) return treeDatas[0];}, [treeDatas])


  return (
        <div className="tree-screen">
            <div className='w-full flex justify-center items-center rounded-md border-1 border-gray-500 py-[50px]'>
                <input type="text" value={userName} onChange={(e) => setUserName(e.target.value)} placeholder={"Search by username"}
                className="w-64 h-12 mx-auto rounded-[60px] border-2 placeholder:text-left outline-none p-5"
                />
            </div>
            <main className="overflow-x-scroll overflow-y-auto grow">
            <TreeNode
                        style={{ display: "flex", flexDirection: "column" }}
                        node={root}
                        />
                    </main>
                </div>
  )
}

export default BinaryTree;
