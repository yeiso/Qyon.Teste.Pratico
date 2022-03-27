import * as React from 'react';
import TableCell from '@mui/material/TableCell';
import TableRow from '@mui/material/TableRow';
import Link from 'next/link';


interface BankInfoProps {
    id: number;
    conta: string;
    total: number;
}

const DataTable: React.FC<BankInfoProps> = ({
id,
conta,
total,
}) =>{
    return (

    <TableRow key={id} hover={true}>
      <TableCell component="th" scope="row"> {id} </TableCell>
      <TableCell align="center"><Link href={{ pathname:'/transferencia/'+[id]}}>
          <a> {conta} </a> 
      </Link>
      </TableCell>
      <TableCell align="right">${total}</TableCell>
    </TableRow>

    );
};

export default DataTable;