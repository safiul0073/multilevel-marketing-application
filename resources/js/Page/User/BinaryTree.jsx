import React, { useState } from 'react'
import { binaryTreeData } from '../../hooks/queries/user/binaryTreeData';
const BinaryTree = () => {

    const { data:treeDatas, isLoading, refetch } = binaryTreeData();

    const binaryData = (datas) => {
        var arr = []

       if (datas?.length > 0) {
        var users = Object.entries(datas)
        for (let i=0; i<users.length; i++) {
            // if (!users[i]['sponsor_id']){
            //     arr[users[i]['id']] = users[i]
            // }
            return arr;
        }
       }

        console.log(arr)
    }
  return (
    <>
    <div className="min-h-full">
                <div className="flex flex-1 flex-col lg:pl-64">
                    <main className="flex-1 py-8">
                        <div className="container">

                    </main>
                </div>
            </div>
    </>
  )
}

export default BinaryTree;
