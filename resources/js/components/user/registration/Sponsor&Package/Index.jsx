import React, { useMemo, useState } from 'react'
import Select from 'react-select';
import TableView from './TableView';
import BlockView from './BlockView';
import { getUserList } from '../../../../hooks/queries/user/getUserList';
import { getProductList } from '../../../../hooks/queries/product/getProductList';
import LoaderAnimation from '../../../common/LoaderAnimation';

const customStyles = {
    control: (base, state) => ({
      ...base,
      background: '#fff',
      height: '40px',

      // Overwrittes the different states of border
      borderColor: state.isFocused ? '#D1D5DB' : '#D1D5DB',
      // Removes weird border around container
      boxShadow: state.isFocused ? null : null,
      '&:hover': {
        // Overwrittes the different states of border
        borderColor: state.isFocused ? '#000080' : '#000080',
      },
    }),
    option: (provided, state) => ({
      ...provided,
      color: state.isSelected ? 'white' : '#111827',
      backgroundColor: state.isSelected ? '#000080' : '#fff',
      fontSize: state.selectProps.myFontSize,
    }),
  };

const Index = ({ setTab }) => {

    const [isTable, setTable] = useState(true)
    const {data:users} = getUserList()
    const { data, isLoading } = getProductList();
    // memorizing getting data
    const productList = useMemo(() => data?.data, [data]);


  return (
    <>
        <div className=' w-2/3 h-full mx-auto'>
            <div className='formGroup'>
                <label
                    htmlFor='sponsor_id'
                    className="label-style">
                    Sponsor Username
                </label>
                <Select
                    name="sponsor_id"
                    options={users}
                    styles={customStyles}
                    id="sponsor_id"
                />
            </div>
            {/* package table */}
            <div>
                <div className='flex py-2 my-1'>
                    <button onClick={ () => setTable(false)} className='mr-2 btn btn-primary'>Block view</button>
                    <button onClick={ () => setTable(true)} className='btn btn-primary'>Table view</button>
                </div>
            {isLoading ? (
                        <LoaderAnimation />
                    ) : (
                        <>
                            {productList?.length ? (
                                <div className="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    { isTable ? <TableView lists={productList} /> : <BlockView lists={productList} /> }
                                </div>
                            ) : (
                                <div className="text-center border border-gray-200 px-5 py-10 rounded-2xl">
                                    <svg
                                        className="mx-auto h-12 w-12 text-gray-400"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        strokeWidth={1.5}
                                        stroke="currentColor"
                                    >
                                        <path
                                            strokeLinecap="round"
                                            strokeLinejoin="round"
                                            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"
                                        />
                                    </svg>

                                    <h3 className="mt-2 text-sm font-medium text-gray-900">
                                        No projects
                                    </h3>
                                    <p className="mt-1 text-sm text-gray-500">
                                        Get started by
                                        creating a new
                                        project.
                                    </p>
                                </div>
                            )}
                        </>
                    )}
            </div>
            {/* next or continue button */}
            <div className='float-left py-2 my-2'>
                <button onClick={() => setTab('userInfo')} className='btn btn-primary'>Continue </button>
            </div>
        </div>
    </>
  )
}

export default Index
