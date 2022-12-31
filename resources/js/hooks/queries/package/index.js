import { userAxios } from "../../../config/axios.config";
import { APIURL } from "../../../constent";

export const createPackage = async (inputData) => {

    const res = await userAxios.post(`${APIURL}/staff/package`, inputData);

    return res?.data?.data?.string_data;
};

export const updatePackage = async (inputData) => {
    const res = await userAxios.post(
        `${APIURL}/staff/package-update/`,
        inputData
    );

    return res?.data?.data?.string_data;
};

export const deletePackage = async (id) => {
    const res = await userAxios.delete(`${APIURL}/staff/package/${id}`);

    return res?.data?.data?.string_data;
};
