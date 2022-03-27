import Header from "../ui/surfaces/Header";

function MyApp({ Component, pageProps }) {
  return (
  <>
  <Header />
  <Component {...pageProps} />
  </>
  );  
}

export default MyApp;
