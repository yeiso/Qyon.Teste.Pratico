import * as React from 'react';
import TableCell from '@mui/material/TableCell';
import TableRow from '@mui/material/TableRow';
import { format } from 'fecha';


interface TransferInfoProps {
    id: number;
    conta_id: number;
    conta: string;
    valor: number;
    movimento: string;
    created_at: string;
}

// const data = format({created_at}, 'YYYY-MM-DD HH:mm:ss');
const TransferTable: React.FC<TransferInfoProps> = ({
id,
conta_id,
conta,
valor,
movimento,
created_at,
}) =>{

  const dataF = format(new Date(created_at), 'DD/MM/YYYY HH:mm:ss');

    return (

    <TableRow key={id} hover={true}>
      <TableCell component="th" scope="row"> {id} </TableCell>
      <TableCell align="center"> {conta_id} </TableCell>
      <TableCell align="center"> {conta} </TableCell>
      <TableCell align="center"> ${valor} </TableCell>
      <TableCell align="right"> {movimento} </TableCell>
      <TableCell align="right"> {dataF} </TableCell>
    </TableRow>

    );
};

export default TransferTable;