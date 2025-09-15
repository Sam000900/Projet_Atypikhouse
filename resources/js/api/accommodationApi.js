import axios from 'axios';

// Get the accommodations 9 by 9 and by decreasing order
export const getLastNineAccommodations = async (page = 1) => {
  try {
    const response = await axios.get(`/accommodations/getLastNine?page=${page}`);
    return response.data;
  } catch (error) {
    return console.error(error);
  }
}

// Get the last 3 accommodations
export const getLastThreeAccommodations = async () => {
  try {
    const response = await axios.get('/accommodations/getLastThree');
    return response.data;
  } catch (error) {
    return console.error(error);
  }
}

// Get accommodations by types and by decreasing order for 5 differents types (Bulles, Yourtes, Péniches, Cabane and Random)
export const getAccommodationsByTypes = async () => {
  try {
    const response = await axios.get('/accommodations/getByTypes');
    return response.data;
  } catch (error) {
    return console.error(error);
  }
}

// Get all the images for a specific accommodation
export const getAccommodationsImages = async (accommodationId) => {
  try {
    const response = await axios.get(`/accommodation-images/${accommodationId}`);
    return response.data;
  } catch (error) {
    return console.error(error);
  }
}

// Get all the reservations for a specific accommodation
export const getAccommodationReservations = async (accommodationId) => {
  try {
    const response = await axios.get(`/accommodation-reservations/${accommodationId}`);
    return response.data;
  } catch (error) {
    return console.error(error);
  }
}

// Get the last hundred accommodations
export const getLastHundredAccommodations = async (page = 1) => {
  try {
    const response = await axios.get(`/accommodations/getLastHundred?page=${page}`);
    return response.data;
  } catch (error) {
    return console.error(error);
  }
}

// Search accommodation with parameters
export async function searchAccommodations(params, page = 1) {
  try {
    const response = await axios.get("/accommodations/search", { params: { ...params, page } });
    return response.data;
  } catch (error) {
    return console.error(error);
  }
}