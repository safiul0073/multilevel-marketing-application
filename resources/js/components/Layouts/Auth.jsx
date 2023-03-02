
import React, { useEffect } from 'react'
import { useRedirectRoute } from '../../hooks/others';

export default function AuthLayout ({children}) {
    useRedirectRoute();
  return (
    <div>
        {/* only login component using this layout */}
        {children}
    </div>
  )
}
