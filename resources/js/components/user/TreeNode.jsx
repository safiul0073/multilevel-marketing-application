import React from "react";
import { useEffect, useState } from "react";

export default function TreeNode(props) {
  const [node, setNode] = useState(props.node);
  const [firstChild, setFirstChild] = useState()
  const [secondchild, setSecondChild] = useState()

  useEffect(() => {
    setNode(props.node);
    setFirstChild(props.node?.children?.find((data) => data.id == props.node.left_ref_id))
    setSecondChild(props.node?.children?.find((data) => data.id == props.node.right_ref_id))
    return () => {};
  }, [props.node]);


  const fullname = (row) => {
    if (row?.first_name && row?.last_name) {
        // return row?.first_name + " " + row?.last_name
        return row?.id
    }else{
        return row?.id
    }
  }

  const checkingUser = (row) => {
    if (row?.id) {
        return  (<div key={node?.id}>
                    <label className="pl-8">{row?.id}</label>
                </div>)
    }else {
        return  (<div key={Math.random()}>
                    <label className="pl-8">Add new</label>
                </div>)
    }
  }

  return (
    <div>
      {(node?.children?.length > 0) ? (
        <div>
          <label >{fullname(node)}</label>
          <div
           className="flex flex-row justify-around"
          >
            <TreeNode node={firstChild} />
            <TreeNode node={secondchild} />
          </div>
        </div>
      ) :
           checkingUser(node)
      }
    </div>
  );
}
