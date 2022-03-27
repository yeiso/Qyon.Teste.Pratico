import { useState, useEffect } from "react";
import axios from 'axios';

export function useIndex(){
    
    const baseURL = 'http://127.0.0.1:8000/api/banco'
    const [bank, setBank] = useState(null);

    

    useEffect(() => {
        axios.get(baseURL).then((response) => {
            setBank(response.data.data);
        });
    }, []);

    return {
        bank
    }
    
}