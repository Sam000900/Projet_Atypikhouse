import axios from 'axios';

// Get the logged user informations
export const getLoggedUser = async () => {
  try {
    const response = await axios.get('/logged-user');
    return response.data;
  } catch (error) {
    return console.error(error);
  }
}

// Get the last hundred users informations
export const getLastHundredUsers = async (page = 1) => {
  try {
    const response = await axios.get(`/users/getLastHundred?page=${page}`);
    return response;
  } catch (error) {
    return console.error(error);
  }
}