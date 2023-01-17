import React, { useEffect, useMemo, useReducer, useState } from "react";
import Protected from "../../components/HOC/Protected";
import Datepicker from "react-tailwindcss-datepicker";
import { useMutation } from "react-query";
import { incentiveBonusGive, incentiveSearch } from "../../hooks/queries/bonus";
import toast from "react-hot-toast";
import * as dayjs from 'dayjs'

const reducer = (state, action) => {
    switch (action.type) {
        case "count_inputed":
            return {
                ...state,
                count: action.value
            }
        case "amount_inputed":
            return {
                ...state,
                amount: action.value
            }
        case "date_inputed":
            return {
                ...state,
                from_date: action.value.startDate,
                to_date: action.value.endDate
            }
        case "reset_all":
            return {
                ...state,
                count: 0,
                amount: 0
            }
        default:
            return state;
    }
  };
const Incentive = () => {
    const [backendError, setBackendError] = useState()
    const [dateValue, setDate] = useState({
        startDate: new Date(),
        endDate: new Date().setMonth(11)
    });
    const [incentive, dispatch] = useReducer(reducer,{
        from_date: dayjs(dateValue.startDate).format("YYYY-MM-DD"),
        to_date: dayjs(dateValue.endDate).format("YYYY-MM-DD"),
        count: 0,
        amount: 0
    });

    const handleValueChange = (newValue) => {
        setDate(() => newValue);
        dispatch({
            type: 'date_inputed',
            value: newValue
        })
    }

    const getMemberCount = () => {
        incentiveSearchMutate({
            from_date: incentive.from_date,
            to_date: incentive.to_date
        })
    }

    const giveBonus = () => {
        if (!incentive.amount) return false
        incentiveBonusGiveMutate(incentive)
    }

    const {
        mutate: incentiveSearchMutate,
        isLoading: searchLoading,
      } = useMutation(incentiveSearch, {
        onSuccess: (data) => {
            toast.success('Member found.', {
                position: 'top-right'
            });
            dispatch({
                type: 'count_inputed',
                value: data?.count
            })
        },
        onError: (err) => {
          let errorobj = err?.response?.data?.data?.json_object;
          setBackendError({
            ...backendError,
            ...errorobj,
          });
        },
      });

      const {
        mutate: incentiveBonusGiveMutate,
        isLoading: bonusGiveLoading,
      } = useMutation(incentiveBonusGive, {
        onSuccess: (data) => {
            toast.success(data, {
                position: 'top-right'
            });

            dispatch({type: 'reset_all'})
        },
        onError: (err) => {

          let errorobj = err?.response?.data?.data?.json_object;
          setBackendError({
            ...backendError,
            ...errorobj,
          });
        },
      });
    return (
        <>
            <div className="min-h-full">
                <div className="flex flex-1 flex-col lg:pl-64">
                    <main className="flex-1 py-8">
                        <div className="container ">
                            <div className="w-1/2 mx-auto px-2 py-2 border border-indigo-400 ">
                                <label className="label-style" >Select from date and to date: </label>
                                <Datepicker
                                    primaryColor={"indigo"}
                                    value={dateValue}
                                    onChange={handleValueChange}
                                    showShortcuts={true}
                                    inputClassName="outline-indigo-500 my-3"
                                />
                                {
                                    searchLoading
                                    ? <>
                                        <button className="btn btn-primary flex justify-center align-center" type="button" disabled>
                                            <svg className="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4"></circle>
                                            <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                        Processing ...
                                        </button>
                                    </>
                                    : <button onClick={getMemberCount} className="btn btn-primary">Search</button>
                                }

                            </div>

                            <div className="w-1/2 mx-auto px-2 py-2 border border-indigo-400 my-4">
                                <div className="formGroup">
                                    <label className="label-style">Total Member</label>
                                    <input
                                        type="number"
                                        // disabled
                                        className="form-control"
                                        value={incentive.count}
                                        onChange={(e) => dispatch({type:'count_inputed', value:e.target.value})}
                                    />
                                    <span className="error-message"> {backendError?.count}</span>
                                </div>
                                <div className="formGroup">
                                    <label className="label-style">Enter amount</label>
                                    <input
                                        type="number"
                                        // disabled
                                        className="form-control"
                                        value={incentive.amount}
                                        onChange={(e) => dispatch({type:'amount_inputed', value:e.target.value})}
                                    />
                                    <span className="error-message"> {backendError?.amount}</span>
                                </div>
                                {
                                    bonusGiveLoading
                                    ? <>
                                        <button className="btn btn-primary flex justify-center align-center" type="button" disabled>
                                            <svg className="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4"></circle>
                                            <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                        Processing ...
                                        </button>
                                    </>
                                    : <button onClick={giveBonus} className="w-full btn btn-primary">Submit</button>
                                }
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </>
    );
};

export default Protected(Incentive);

