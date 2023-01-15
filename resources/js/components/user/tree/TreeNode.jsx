import React from "react";
import { useMemo } from "react";
import { useEffect, useState } from "react";
import { NewAddView } from "./NewAddView";
import UserView from "./UserView";

export default function TreeNode({
    node,
    before = false,
    sponsor = null,
    position = "",
}) {
    const [firstChild, setFirstChild] = useState();
    const [secondChild, setSecondChild] = useState();

    useEffect(() => {
        setFirstChild(
            node?.children?.find((data) => data.id == node.left_ref_id)
        );
        setSecondChild(
            node?.children?.find((data) => data.id == node.right_ref_id)
        );
        return () => {};
    }, [node]);

    return node ? (
        <div
            className={`flex flex-col w-auto justify-start relative before:absolute before:h-1 before:top-0 before:bg-gray-400 ${
                position === "right"
                    ? "before:left-[0%] before:right-[50%]"
                    : position === "left"
                    ? "before:left-[50%] before:right-[0%]"
                    : ""
            }`}
        >
            <UserView user={node} before={before} />
            <div className="flex relative after:absolute after:bottom-full after:left-1/2 after:-translate-x-1/2 after:w-1 after:h-3 after:bg-gray-400">
                <TreeNode
                    node={firstChild}
                    before={true}
                    position="left"
                    sponsor={node?.id}
                />
                <TreeNode
                    node={secondChild}
                    before={true}
                    position="right"
                    sponsor={node?.id}
                />
            </div>
        </div>
    ) : (
        <NewAddView position={position} referral={sponsor} />
    );
}
