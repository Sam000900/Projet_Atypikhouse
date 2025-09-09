import axios from 'axios';

// Get the reservations for a specific user
export const getUserReservations = async () => {
  try {
    const response = await axios.get('/reservations/getuserreservations');
    return response.data;
  } catch (error) {
    return console.error(error);
  }
}