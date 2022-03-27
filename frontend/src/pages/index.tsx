import React from "react";
import DataTable from "../ui/components/DataTable";
import { useIndex } from "../data/hooks/useIndex";
import { Typography } from "@material-ui/core";
import { TableContainer, TableHead, TableRow, TableCell, Container, Grid, Box } from "@mui/material";

export default function Home() {

  const banks = useIndex();

  return (
    <Grid container sx={{ mt: 3 }} direction="column" alignItems="center" justifyContent="center">
      <Typography align="center" variant="h4" >Todos as contas</Typography>        
      <Grid sx={{ mt: 3 }}>
      <TableContainer>
        <TableHead>
          <TableRow>
            <TableCell>ID</TableCell>
            <TableCell align="center">Conta</TableCell>
            <TableCell align="right">Total</TableCell>
          </TableRow>
        </TableHead>
      {banks.bank?.map((bank, index) => {
        return(   
          <DataTable
            key={index}
            id={bank.id}
            conta={bank.conta}
            total={bank.total}
          />
        );
      })}
       </TableContainer>
      </Grid>
    </Grid>
  );
}
