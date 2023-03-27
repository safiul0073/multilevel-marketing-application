import React from 'react'
import { useQuery } from "../../hooks/others/index";
const Details = () => {

    const query = useQuery()
    console.log(query)
  return (
    <div>Details</div>
  )
}

export default Details
