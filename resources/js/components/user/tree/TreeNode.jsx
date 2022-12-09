import React from "react";
import { useMemo } from "react";
import { useEffect, useState } from "react";
import { NewAddView } from "./NewAddView";
import UserView from "./UserView";

export default function TreeNode(props) {
  const [node, setNode] = useState(props.node);
  const [firstChild, setFirstChild] = useState()
  const [secondChild, setSecondChild] = useState()

  useEffect(() => {
    setNode(props.node);
    setFirstChild(props.node?.children?.find((data) => data.id == props.node.left_ref_id))
    setSecondChild(props.node?.children?.find((data) => data.id == props.node.right_ref_id))
    return () => {};
  }, [props.node]);

  const checkingUser = (row) => {

    if (row?.id) {
        return  (<div >
            <UserView user={row} />
          <div className="flex flex-row justify-around">
            <NewAddView sponsor_id={row?.id} />
            <NewAddView sponsor_id={row?.id} />
          </div>
        </div>)
    }else {

        return  (<NewAddView sponsor_id={3} />)
    }
  }


  return (
    <div>
      {(node?.children?.length > 0) ? (
        <div >
            <UserView user={node} />
          <div className="flex flex-row justify-around">
            <TreeNode node={firstChild} />
            <TreeNode node={secondChild} />
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
