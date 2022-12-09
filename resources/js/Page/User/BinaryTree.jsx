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
    <>
    <div className="min-h-full">
                <div className="flex flex-1 flex-col lg:pl-64">
                    <main className="flex-1 py-8 text-center overflow-x-auto overflow-y-auto">
                    <TreeNode
                        style={{ display: "flex", flexDirection: "column" }}
                        node={root}
                        />
                    </main>
                </div>
            </div>
    </>
  )
}

export default BinaryTree;
