import React, { useEffect, useMemo, useState } from 'react'
import Select, { createFilter } from 'react-select';
import TableView from './TableView';
import BlockView from './BlockView';
import { getUserList } from '../../../../hooks/queries/user/getUserList';
import LoaderAnimation from '../../../common/LoaderAnimation';
import { UseStore } from '../../../../store';
import { useQuery } from '../../../../hooks/others';
import toast from 'react-hot-toast';
import { allPackageList } from '../../../../hooks/queries/package/allPackageList';

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

const Index = ({ setTab, backendError  }) => {
    let query = useQuery();

    const sponsorId = query.get('sponsor_id')
    const {userRegister} = UseStore()
    const [username, setUsername] = useState()
    const [referPosition, setReferPosition] = useState('')
    const [productId, setProductId] = useState()
    const [isTable, setTable] = useState(true)
    const {data:users} = getUserList()
    const { data, isLoading } = allPackageList();
    // memorizing getting data
    const productList = useMemo(() => data, [data]);
	const selectFilter = createFilter({
		matchFrom: "start",
		ignoreCase: true,
		trim: true,
	});
    const handleSelectSearch = (e) => {
        let usern = users?.find((p) => p.value == e.value)
        setUsername(usern)
        userRegister.sponsor_id = e.value
    }

    useEffect(() => {
        if (sponsorId) {
            let usern = users?.find((p) => p.value == sponsorId)
            setUsername(usern)
            userRegister.sponsor_id = sponsorId

            if (!usern?.left_ref_id && usern?.right_ref_id) {
                setReferPosition('left')
                userRegister.refer_position = 'left'
            } else if (usern?.left_ref_id && !usern?.right_ref_id) {
                setReferPosition('right')
                userRegister.refer_position = 'right'
            }
        }
        if (userRegister?.sponsorId) {
            let usern = users?.find((p) => p.value == userRegister?.sponsorId)
            setUsername(usern)
            userRegister.sponsor_id = sponsorId
        }
        if (userRegister?.refer_position) {
            setReferPosition(userRegister?.refer_position)
        }

        if (userRegister?.product_id) {
            setProductId(userRegister?.product_id)
        }

        return () =>  {}
    }, [sponsorId, productList, userRegister])



    const handlePosition = (e) => {
        setReferPosition(e.target.value)
        userRegister.refer_position = e.target.value
    }

    const handleContinue = () => {
        userRegister.product_id = productId
        if (checkValidation()) {
            toast.error(checkValidation(), {
                position: 'top-center'
            });
        }else {
            setTab('userInfo')
        }
    }

    const checkValidation = () => {

        if (!userRegister?.sponsor_id) {
            return 'Please select a sponsor username!';
        }

        if (!userRegister?.refer_position) {
            return 'Please select referrer Position!';
        }

        if (!userRegister?.product_id) {
            return 'Please select a package!';
        }
        return false;
    }

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
                    value={username}
                    id="sponsor_id"
                    filterOption={selectFilter}
                    onChange={handleSelectSearch}
                />
            </div>
            <div className='formGroup'>
                <label
                    htmlFor='refer_position'
                    className="label-style">
                    Select position (Left or Right)
                </label>
                <select className='form-control' value={referPosition} onChange={handlePosition} id="refer_position">
                    <option value="">Select Left or Right</option>
                    <option value="left">Left</option>
                    <option value="right">Right</option>
                </select>
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
                                <div className="-my-2 -mx-4 overflow-x-auto overflow-y-auto h-[600px] sm:-mx-6 lg:-mx-8">
                                    { isTable ? <TableView productId={productId} setProductId={setProductId} lists={productList} /> : <BlockView  productId={productId} setProductId={setProductId} lists={productList} /> }
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
                <button onClick={handleContinue} className='btn btn-primary'>Continue </button>
            </div>
        </div>
    </>
  )
}

export default Index
