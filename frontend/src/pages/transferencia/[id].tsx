import React from "react";
import TransferTable from "../../ui/components/TransferTable";
import { useTransferencias } from "../../data/hooks/useTransferencias";
import { Typography } from "@material-ui/core";
import { TableContainer, TableHead, TableRow, TableCell, Container, Grid, Button } from "@mui/material";
import { useRouter } from "next/router";


export default function Transfer() {

  const transfers = useTransferencias();
  const router = useRouter();
  const id = router.query.id;

  console.log(transfers);

  return (
    <Grid container sx={{ mt: 3 }} direction="column" alignItems="center" justifyContent="center">
      <Typography align="center" variant="h4" >Extrato da conta {id}</Typography>
      <Grid sx={{ mt: 3 }}>
      <TableContainer> 
        <TableHead>
          <TableRow>
            <TableCell>ID</TableCell>
            <TableCell>Conta ID</TableCell>
            <TableCell align="center">Conta</TableCell>
            <TableCell align="right">Valor</TableCell>
            <TableCell align="right">Movimento</TableCell>
            <TableCell align="center">Data</TableCell>
          </TableRow>
        </TableHead>
      {transfers.transfer?.map((transfer, index) => {
        return(
          <TransferTable
            key={index}
            id={transfer.id}
            conta_id={transfer.conta_id}
            conta={transfer.conta}
            valor={transfer.valor}
            movimento={transfer.movimento}
            created_at={transfer.created_at}
          />
        );
      })}
      </TableContainer>
      <Button sx={{ mt: 3 }} variant="contained" href="/"> Voltar </Button>
      </Grid>
    </Grid>
  );
}
