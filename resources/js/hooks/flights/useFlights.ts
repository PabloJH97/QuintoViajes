import { useMutation, useQuery } from "@tanstack/react-query";
import axios from "../../lib/axios";

export interface Flight {
  id: string;
  code: string;
  plane: string;
  origin: string;
  destination: string;
  price: number;
  date: string;
  seats: string;
  state: string;
  created_at: string;
}

// Interface representing the actual API response structure
export interface ApiPaginatedResponse<T> {
  current_page: number;
  data: T[];
  first_page_url: string;
  from: number;
  last_page: number;
  last_page_url: string;
  links: Array<{
    url: string | null;
    label: string;
    active: boolean;
  }>;
  next_page_url: string | null;
  path: string;
  per_page: number;
  prev_page_url: string | null;
  to: number;
  total: number;
}

// Interface representing the expected format for the Table component
export interface PaginatedResponse<T> {
  data: T[];
  meta: {
    current_page: number;
    from: number;
    last_page: number;
    per_page: number;
    to: number;
    total: number;
  };
}

interface UseFlightsParams {
  search?: any[];
  page?: number;
  perPage?: number;
}

export function useFlights({ search, page = 1, perPage = 10 }: UseFlightsParams = {}) {
  return useQuery({
    queryKey: ["flights", { search, page, perPage }],
    queryFn: async () => {
      const { data: apiResponse } = await axios.get<ApiPaginatedResponse<Flight>>("/api/flights", {
        params: {
          search,
          page,
          per_page: perPage,
        },
        headers: {
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        }
      });

      // Transform the API response to the expected format
      return {
        data: apiResponse.data,
        meta: {
          current_page: apiResponse.current_page,
          from: apiResponse.from,
          last_page: apiResponse.last_page,
          per_page: apiResponse.per_page,
          to: apiResponse.to,
          total: apiResponse.total
        }
      } as PaginatedResponse<Flight>;
    },
  });
}

export function useCreateFlight() {
  return useMutation({
    mutationFn: async (data: { name: string;}) => {
      const response = await axios.post("/api/flights", data, {
        headers: {
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        }
      });
      return response.data;
    },
  });
}

export function useUpdateFlight(flightId: string) {
  return useMutation({
    mutationFn: async (data: { name: string;}) => {
      const response = await axios.put(`/api/flights/${flightId}`, data, {
        headers: {
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        }
      });
      return response.data;
    },
  });
}

export function useDeleteFlight() {
  return useMutation({
    mutationFn: async (flightId: string) => {
      await axios.delete(`/api/flights/${flightId}`, {
        headers: {
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        }
      });
    },
  });
}
