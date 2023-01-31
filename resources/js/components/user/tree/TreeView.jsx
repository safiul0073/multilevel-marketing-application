import React from "react";
import { binaryTreeData } from "../../../hooks/queries/user/binaryTreeData";
import LoaderAnimation from "../../common/LoaderAnimation";
import TreeNode from "./TreeNode";
import usePanZoom from "use-pan-and-zoom";

const TreeView = ({ username }) => {

    const { transform,
        setContainer,
        panZoomHandlers,
        setPan,
        setZoom } = usePanZoom();
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
                <div>
                    <div className="flex gap-2 justify-center items-center my-3">
                        <button className="btn btn-success" onClick={() => setPan({ x: 0, y: 0 })}>Reset pan</button>
                        <button className="btn btn-success" onClick={() => setZoom(1)}>Reset zoom</button>
                    </div>
                    <main
                    ref={(el) => setContainer(el)}
                    style={{ touchAction: "none" }}
                    {...panZoomHandlers}
                    className=" overflow-x-auto overflow-y-auto grow p-5 pt-0 flex flex-col ">
                        <div style={{ transform }} className="mx-auto">
                            <TreeNode
                                node={root}
                            />
                        </div>
                    </main>
                </div>
            )}
        </>
    );
};

export default TreeView;
