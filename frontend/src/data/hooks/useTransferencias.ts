import { useState, useEffect } from "react";
import { useRouter } from "next/router";
import axios from 'axios';

export function useTransferencias(){
    
    const router = useRouter();
    const id = router.query.id;
    const baseURL = 'http://127.0.0.1:8000/api/transferencia/' + id;
    const [transfer, setTransfer] = useState(null);

    useEffect(() => {
        axios.get(baseURL).then((response) => {
            setTransfer(response.data);
        });
    }, []);

    return {
        transfer,
    }
    
}