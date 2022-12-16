import React, { useEffect } from 'react'
import { useMemo } from 'react';
import TreeNode from '../../components/user/tree/TreeNode';
import { binaryTreeData } from '../../hooks/queries/user/binaryTreeData';
const BinaryTree = () => {
    // fetching binary tree user data
    const { data:treeDatas, isLoading, refetch } = binaryTreeData();

    // finding root user
    const root = useMemo(() => {for (let i = 0; i<treeDatas?.length; i++) return treeDatas[0];}, [treeDatas])

  return (
        <div className="tree-screen">
            <div className='w-full flex justify-center items-center rounded-md border-1 border-gray-500'>
                <input type="text" className="w-64 h-12" />
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
