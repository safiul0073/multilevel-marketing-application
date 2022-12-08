import React from "react";
import { useEffect, useState } from "react";
import UserView from "./UserView";

export default function TreeNode(props) {
  const [node, setNode] = useState(props.node);
  const [firstChild, setFirstChild] = useState()
  const [secondchild, setSecondChild] = useState()
  // const [nullNode, setNullNode] = useState()

  useEffect(() => {
    setNode(props.node);
    setFirstChild(props.node?.children?.find((data) => data.id == props.node.left_ref_id))
    setSecondChild(props.node?.children?.find((data) => data.id == props.node.right_ref_id))
    // setNullNode(props.)
    return () => {};
  }, [props.node]);


  const fullname = (row) => {
    if (row?.first_name && row?.last_name) {
        return row?.first_name + " " + row?.last_name
        return row?.id
    }else{
        return row?.id
    }
  }

  const checkingUser = (row) => {
    if (row?.id) {
        return  (<UserView user={row} />)
    }else {
        return  (<div key={Math.random()} className="flex flex-col justify-center items-center border-2 border-green-600 m-5 ">
                    <h1 className='bg-green-600 p-2 w-full'>Add new</h1>
                    <img
                      src="https://cdn-icons-png.flaticon.com/512/561/561169.png"
                      width={150}
                      height={150}
                      className=" p-3"
                      alt="" />
                </div>)
    }
  }

  return (
    <div>
      {(node?.children?.length > 0) ? (
        <div >
            <UserView user={node} />
          <div className="flex flex-row justify-around">
            <TreeNode node={firstChild} />
            <TreeNode node={secondchild} />
          </div>
        </div>
      ) : (
        <div className="flex flex-row justify-around">
          {
            checkingUser(node)
          }
        </div>
      )

      }
    </div>
  );
}
