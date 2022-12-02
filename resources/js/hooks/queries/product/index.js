import { userAxios } from "../../../config/axios.config";
import { APIURL } from "../../../constent";

export const createProduct = async (inputData) => {

    const res = await userAxios.post(`${APIURL}/staff/product`, inputData);

    return res?.data?.data?.string_data;
};

export const updateProduct = async (inputData) => {
    const res = await userAxios.post(
        `${APIURL}/staff/product-update/`,
        inputData
    );

    return res?.data?.data?.string_data;
};

export const deleteProduct = async (id) => {
    const res = await userAxios.delete(`${APIURL}/staff/product/${id}`);

    return res?.data?.data?.string_data;
};
