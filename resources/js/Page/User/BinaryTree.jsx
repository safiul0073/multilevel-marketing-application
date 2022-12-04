import React, { Children, useEffect, useState } from 'react'
import { binaryTreeData } from '../../hooks/queries/user/binaryTreeData';
const BinaryTree = () => {

    const { data:treeDatas, isLoading, refetch } = binaryTreeData();

    // const binaryData = (datas) => {
    //     var arr = []

    //    if (datas?.length > 0) {
    //     var users = Object.entries(datas)
    //     for (let i=0; i<users.length; i++) {
    //         // if (!users[i]['sponsor_id']){
    //         //     arr[users[i]['id']] = users[i]
    //         // }
    //         return arr;
    //     }
    //    }
    // }

    const findChild = (arr, id)=>{
        if(id === arr[0].id.toString()){
            return arr[0];
        }else if(id === arr[1].id.toString()){
            return arr[1];
        }else {
            return null;
        }
    }

    let elements = [];

    const createComp = (tree)=>{
        if(tree.left_ref_id === null && tree.right_ref_id === null) return;

        console.log("this is root : ",tree.id);

        if(tree.left_ref_id !== null){
            console.log("left child : ", findChild(tree.children, tree.left_ref_id).id);
            createComp(findChild(tree.children, tree.left_ref_id))
        } 
        
        if(tree.right_ref_id !== null){
            console.log("right child : ", findChild(tree.children, tree.right_ref_id).id);
            createComp(findChild(tree.children, tree.right_ref_id))
        }



        // console.log("left child : ", findChild(tree.children, tree.left_ref_id));
        // console.log("right child : ", findChild(tree.children, tree.right_ref_id));

        // createComp(findChild(tree.children, tree.left_ref_id));
        // createComp(findChild(tree.children, tree.right_ref_id));
    }
    useEffect(()=>{
        treeDatas && treeDatas.map((tree,i)=>{
            createComp(tree);
        })
    },[treeDatas])



    // console.log(treeDatas);
  return (
    <>
    <div className="min-h-full">
                <div className="flex flex-1 flex-col lg:pl-64">
                    <main className="flex-1 py-8">
                        {
                            // treeDatas && treeDatas.map((tree,i)=>{
                            //     createComp(tree);
                            // })
                        }

                    </main>
                </div>
            </div>
    </>
  )
}

export default BinaryTree;
