import axios from 'axios';

// Get the experiences 10 by 10 and by decreasing order
export const getLastTenExperiences = async (page = 1) => {
  try {
    const response = await axios.get(`/experiences/getLastTen?page=${page}`);
    return response.data;
  } catch (error) {
    return console.error(error);
  }
}

// Get experiences by types and by decreasing order for 3 differents types ("Séjours bien-êtres", "Aventures", and "Gastronomie locale")
export const getExperiencesByTypes = async () => {
  try {
    const response = await axios.get('/experiences/getByTypes');
    return response.data;
  } catch (error) {
    return console.error(error);
  }
}

// Get one experience for each 3 types ("Séjours bien-êtres", "Aventures", and "Gastronomie locale")
export const getUniqueExperienceByTypes = async () => {
  try {
    const response = await axios.get('/experiences/getUniqueByTypes'); 
    return response.data;
  } catch (error) {
    return console.error(error);
  }
}

// Get all the reservations for a specific accommodation
export const getExperienceReservations = async (experienceId) => {
  try {
    const response = await axios.get(`/experience-reservations/${experienceId}`);
    return response.data;
  } catch (error) {
    return console.error(error);
  }
}

// Get the last hundred experiences informations
export const getLastHundredExperiences = async (page = 1) => {
  try {
    const response = await axios.get(`/experiences/getLastHundred?page=${page}`);
    return response.data;
  } catch (error) {
    return console.error(error);
  }
}