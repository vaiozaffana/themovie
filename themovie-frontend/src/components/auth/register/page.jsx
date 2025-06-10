"use client"

import { useEffect } from "react"
import { useRouter } from "next/navigation"

export default function Register() {
  const router = useRouter()

  useEffect(() => {
    // Redirect to the login page with register tab active
    router.push("/login?tab=register")
  }, [router])

  return null
}
