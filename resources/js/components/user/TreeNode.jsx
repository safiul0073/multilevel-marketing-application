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



  console.log(node);

  return (
    <div>
      {node?.children ? (
        <div>
          <label className="pr-8">{node?.id}</label>
          <div
           className="flex flex-row justify-around"
          >
            <TreeNode node={firstChild ?? 5} />
            <TreeNode node={secondchild?? 5} />
          </div>
        </div>
      ) : (
        <div key={node?.id}>
          <label className="pl-8">{node?.id}</label>
        </div>
      )}
    </div>
  );
}
