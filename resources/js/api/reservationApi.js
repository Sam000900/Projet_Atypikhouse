import axios from 'axios';

// Get the reservations for a specific user
export const getUserReservations = async () => {
  return await axios
    .get(`/reservations/getuserreservations`)
    .then(response => { return response.data })
    .catch((error) => console.log(error));
}