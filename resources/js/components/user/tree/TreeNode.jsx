import React from "react";
import { useMemo } from "react";
import { useEffect, useState } from "react";
import { NewAddView } from "./NewAddView";
import UserView from "./UserView";

export default function TreeNode({ node, before = false, sponsor = null }) {
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
        <div className="flex flex-col justify-start items-center basis-1/2 shrink-0 w-max">
            <UserView user={node} before={before} />
            <div className="grid grid-cols-2 shrink-0 relative after:absolute after:bottom-full after:left-1/2 after:-translate-x-1/2 after:w-1 after:h-2.5 after:bg-gray-400 before:absolute before:h-1 before:top-0 before:left-[25%] before:right-[25%] before:bg-gray-400">
                <TreeNode node={firstChild} before={true} sponsor={node?.id} />
                <TreeNode node={secondChild} before={true} sponsor={node?.id} />
            </div>
        </div>
    ) : (
        <NewAddView referral={sponsor} />
    );
}
