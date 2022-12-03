import React from 'react'
import { binaryTreeData } from '../../hooks/queries/user/binaryTreeData';

const BinaryTree = () => {

    const { data:treeDatas, isLoading, refetch } = binaryTreeData();


    const binaryData = (datas) => {
        
    }
  return (
    <>
    <div className="min-h-full">
                <div className="flex flex-1 flex-col lg:pl-64">
                    <main className="flex-1 py-8">
                        <div className="container">
dsdfsdfdsf
                                {
                                    treeDatas?.map((user) => (
                                        <div key={user.id}>
                                        hello world
                                        </div>
                                    ))
                                }
                        </div>
                    </main>
                </div>
            </div>
    </>
  )
}

export default BinaryTree;
