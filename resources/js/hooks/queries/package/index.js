import { userAxios } from "../../../config/axios.config";
import { APIURL } from "../../../constant";

export const createPackage = async (inputData) => {

    const res = await userAxios.post(`${APIURL}/staff/package`, inputData);

    return res?.data?.data?.string_data;
};

export const updatePackage = async (inputData) => {
    const res = await userAxios.post(
        `${APIURL}/staff/package/${inputData?.id}`,
        {
            ...inputData,
            _method: "PUT"
          }
    );

    return res?.data?.data?.string_data;
};

export const deletePackage = async (id) => {
    const res = await userAxios.delete(`${APIURL}/staff/package/${id}`);

    return res?.data?.data?.string_data;
};
