import { useEffect } from "react";
import { fetchAllPensioners } from "../services/pensionerService";
import PensionerForm from "../components/PensionerForm";

function CreatePensioner() {
  const fetchData = async () => {
    await fetchAllPensioners();
  };

  useEffect(() => {
    fetchData();
  }, []); //fetch data on component mount
  return <PensionerForm loadPensioners={fetchData} />;
}

export default CreatePensioner;
