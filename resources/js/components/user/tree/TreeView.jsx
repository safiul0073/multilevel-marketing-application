import React from "react";
import { binaryTreeData } from "../../../hooks/queries/user/binaryTreeData";
import LoaderAnimation from "../../common/LoaderAnimation";
import TreeNode from "./TreeNode";

const TreeView = ({ username }) => {
    // fetching binary tree user data
    const { data: treeDatas, isLoading } = binaryTreeData({
        username: username,
    });
    // finding root user
    const root = React.useMemo(() => {
        for (let i = 0; i < treeDatas?.length; i++) return treeDatas[0];
    }, [treeDatas]);

    return (
        <>
            {isLoading ? (
                <LoaderAnimation />
            ) : (
                <main className="overflow-x-auto overflow-y-auto grow p-5 pt-0 flex flex-col">
                    <div className="mx-auto">
                        <TreeNode
                            node={root}
                        />
                    </div>
                </main>
            )}
        </>
    );
};

export default TreeView;
