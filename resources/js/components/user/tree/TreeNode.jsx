import React from "react";
import { useMemo } from "react";
import { useEffect, useState } from "react";
import { NewAddView } from "./NewAddView";
import UserView from "./UserView";

export default function TreeNode(props) {
    const [node, setNode] = useState(props.node);
    const [firstChild, setFirstChild] = useState();
    const [secondChild, setSecondChild] = useState();

    useEffect(() => {
        setNode(props.node);
        setFirstChild(
            props.node?.children?.find(
                (data) => data.id == props.node.left_ref_id
            )
        );
        setSecondChild(
            props.node?.children?.find(
                (data) => data.id == props.node.right_ref_id
            )
        );
        return () => {};
    }, [props.node]);

    const checkingUser = (row) => {
        if (row?.id) {
            return (
                <div>
                    <UserView user={row} />
                    <div className="w-auto grid grid-cols-2 relative before:absolute before:h-1 before:left-[25%] before:right-[25%] before:top-0 before:bg-gray-400 after:absolute after:bottom-full after:left-1/2 after:-translate-x-1/2  after:w-1 after:h-5 after:bg-gray-400">
                        {row?.left_ref_id ? (
                            <div>
                                <UserView user={firstChild} />
                                <div className="flex flex-row justify-around relative before:absolute before:h-1 before:top-0 before:left-[25%] before:right-[25%] before:bg-gray-400 after:absolute after:bottom-full after:left-1/2 after:-translate-x-1/2 after:w-1 after:h-5 after:bg-gray-400">
                                    <NewAddView sponsor_id={row?.left_ref_id} />
                                    <NewAddView sponsor_id={row?.left_ref_id} />
                                </div>
                            </div>
                        ) : (
                            <NewAddView sponsor_id={row?.id} />
                        )}
                        {row?.right_ref_id ? (
                            <div>
                                <UserView user={secondChild} />
                                <div className="flex flex-row justify-around relative before:absolute before:h-1 before:top-0 before:left-[25%] before:right-[25%] before:bg-gray-400 after:absolute after:bottom-full after:left-1/2 after:-translate-x-1/2 after:w-1 after:h-5 after:bg-gray-400">
                                    <NewAddView
                                        sponsor_id={row?.right_ref_id}
                                    />
                                    <NewAddView
                                        sponsor_id={row?.right_ref_id}
                                    />
                                </div>
                            </div>
                        ) : (
                            <NewAddView sponsor_id={row?.id} />
                        )}
                    </div>
                </div>
            );
        } else {
            return <NewAddView sponsor_id={null} />;
        }
    };

    return (
        <>
            {node?.left_ref_id && node?.right_ref_id ? (
                <>
                    <UserView user={node} first={true} />
                    <div className="w-auto grid grid-cols-2 relative before:absolute before:h-1 before:top-0 before:left-[25%] before:right-[25%] before:bg-gray-400 after:absolute after:bottom-full after:left-1/2 after:-translate-x-1/2 after:w-1 after:h-5 after:bg-gray-400">
                        <TreeNode node={firstChild} />
                        <TreeNode node={secondChild} />
                    </div>
                </>
            ) : (
                checkingUser(node)
            )}
        </>
    );
}
