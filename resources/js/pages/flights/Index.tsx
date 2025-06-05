import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { TableSkeleton } from "@/components/stack-table/TableSkeleton";
import { UserLayout } from "@/layouts/users/UserLayout";
import { User, useDeleteUser, useUsers } from "@/hooks/users/useUsers";
import { PencilIcon, PlusIcon, ShoppingCart, TrashIcon } from "lucide-react";
import { useDebounce } from "@/hooks/use-debounce";
import { useState, useMemo } from "react";
import { Link, router, usePage } from "@inertiajs/react";
import { useTranslations } from "@/hooks/use-translations";
import { Table } from "@/components/stack-table/Table";
import { createTextColumn, createDateColumn, createActionsColumn } from "@/components/stack-table/columnsTable";
import { DeleteDialog } from "@/components/stack-table/DeleteDialog";
import { FiltersTable, FilterConfig } from "@/components/stack-table/FiltersTable";
import { toast } from "sonner";
import { ColumnDef, Row } from "@tanstack/react-table";
import { FlightLayout } from "@/layouts/flights/FlightLayout";
import { Flight, useDeleteFlight, useFlights } from "@/hooks/flights/useFlights";
import { isEmpty } from "lodash";


export default function FlightsIndex() {
  const { t } = useTranslations();
  const { url } = usePage();


  // Obtener los parámetros de la URL actual
  const urlParams = new URLSearchParams(url.split('?')[1] || '');
  const pageParam = urlParams.get('page');
  const perPageParam = urlParams.get('per_page');

  // Inicializar el estado con los valores de la URL o los valores predeterminados
  const [currentPage, setCurrentPage] = useState(pageParam ? parseInt(pageParam) : 1);
  const [perPage, setPerPage] = useState(perPageParam ? parseInt(perPageParam) : 10);
  const [filters, setFilters] = useState<Record<string, any>>({});
  // Combine name and email filters into a single search string if they exist
  const combinedSearch = [
    filters.code ? filters.code : 'null',
    filters.plane ? filters.plane : 'null',
    filters.origin ? filters.origin : 'null',
    filters.destination ? filters.destination : 'null',
    filters.price ? filters.price : 'null',
    filters.seats ? filters.seats : 'null',
    filters.date ? filters.date : 'null',
    filters.state ? filters.state : 'null',
    filters.created_at ? filters.created_at : 'null',
  ];

  const { data: flights, isLoading, isError, refetch } = useFlights({
    search: combinedSearch,
    page: currentPage,
    perPage: perPage,
  });
  const deleteFlightMutation = useDeleteFlight();
  const [filterState, setFilterState]=useState(false);

  const handlePageChange = (page: number) => {
    setCurrentPage(page);
  };

  const handlePerPageChange = (newPerPage: number) => {
    setPerPage(newPerPage);
    setCurrentPage(1); // Reset to first page when changing items per page
  };
  const handleFilterChange = (newFilters: Record<string, any>) => {
    const filtersChanged = newFilters!==filters;

    if (filtersChanged) {
        setCurrentPage(1);
    }
    isEmpty(filters) ? setFilterState(false) : setFilterState(true)
    setFilters(newFilters);
    };

  const handleDeleteFlight = async (id: string) => {
    try {
      await deleteFlightMutation.mutateAsync(id);
      refetch();
    } catch (error) {
      toast.error(t("ui.flights.deleted_error") || "Error deleting flight");
      console.error("Error deleting flight:", error);
    }
  };
  function handleCreateTicket(code: string){
    router.get(`tickets/create`, {code})
  }

  function ShopButton(code: string){
    return(
        <Button variant="outline" size="icon" title={t("ui.flights.buttons.shop") || "Buy a ticket"} onClick={()=>handleCreateTicket(code.code)}>
            <ShoppingCart></ShoppingCart>
        </Button>
    )
  }

  const columns = useMemo(() => ([
    createTextColumn<Flight>({
      id: "code",
      header: t("ui.flights.columns.code") || "Code",
      accessorKey: "code",
    }),
    createTextColumn<Flight>({
      id: "plane",
      header: t("ui.flights.columns.plane") || "Plane",
      accessorKey: "plane",
    }),
    createTextColumn<Flight>({
      id: "origin",
      header: t("ui.flights.columns.origin") || "Origin",
      accessorKey: "origin",
    }),
    createTextColumn<Flight>({
      id: "destination",
      header: t("ui.flights.columns.destination") || "Destination",
      accessorKey: "destination",
    }),
    createTextColumn<Flight>({
      id: "price",
      header: t("ui.flights.columns.price") || "Price",
      accessorKey: "price",
    }),
    createTextColumn<Flight>({
      id: "seats",
      header: t("ui.flights.columns.seats.name") || "Seats",
      format: (value) => {
            let returnedValue=t(`ui.flights.columns.seats.${value}`);
            let aux;
            let res: string[] = [];
            if (value.includes(',')) {
                aux = value.split(', ');
                aux.map((seat) => {
                    seat = t(`ui.flights.columns.seats.${seat}`);
                    res=[...res, seat];
                });
                aux = res.join(', ');
                returnedValue=aux;
            }
            return returnedValue;
        },
      accessorKey: "seats",
    }),
    createTextColumn<Flight>({
      id: "state",
      header: t("ui.flights.columns.state.name") || "State",
      format: (value)=>{
            return t(`ui.flights.columns.state.${value}`)
        },
      accessorKey: "state",
    }),
    createTextColumn<Flight>({
      id: "date",
      header: t("ui.flights.columns.date") || "Date",
      accessorKey: "date",
    }),
    createDateColumn<Flight>({
      id: "created_at",
      header: t("ui.flights.columns.created_at") || "Created At",
      accessorKey: "created_at",
    }),
    createActionsColumn<Flight>({
      id: "actions",
      header: t("ui.flights.columns.actions") || "Actions",
      renderActions: (flight) => (
        <>
        <ShopButton code={flight.code}></ShopButton>
          <Link href={`/flights/${flight.id}/edit?page=${currentPage}&perPage=${perPage}`}>
            <Button variant="outline" size="icon" title={t("ui.flights.buttons.edit") || "Edit flight"}>
              <PencilIcon className="h-4 w-4" />
            </Button>
          </Link>
          <DeleteDialog
            id={flight.id}
            onDelete={handleDeleteFlight}
            title={t("ui.flights.delete.title") || "Delete flight"}
            description={t("ui.flights.delete.description") || "Are you sure you want to delete this flight? This action cannot be undone."}
            trigger={
              <Button variant="outline" size="icon" className="text-destructive hover:text-destructive" title={t("ui.flights.buttons.delete") || "Delete flight"}>
                <TrashIcon className="h-4 w-4" />
              </Button>
            }
          />
        </>
      ),
    }),
  ] as ColumnDef<Flight>[]), [t, handleDeleteFlight]);

  return (
      <FlightLayout title={t('ui.flights.title')}>
          <div className="p-6">
              <div className="space-y-6">
                  <div className="flex items-center justify-between">
                      <h1 className="text-3xl font-bold">{t('ui.flights.title')}</h1>
                      <Link href="/flights/create">
                          <Button>
                              <PlusIcon className="mr-2 h-4 w-4" />
                              {t('ui.flights.buttons.new')}
                          </Button>
                      </Link>
                  </div>
                  <div></div>

                  <div className="space-y-4">
                      <FiltersTable
                          filters={
                              [
                                  {
                                      id: 'code',
                                      label: t('ui.flights.filters.code') || 'Code',
                                      type: 'text',
                                      placeholder: t('ui.flights.placeholders.code') || 'Code...',
                                  },
                                  {
                                      id: 'plane',
                                      label: t('ui.flights.filters.plane') || 'Plane',
                                      type: 'text',
                                      placeholder: t('ui.flights.placeholders.plane') || 'Plane...',
                                  },
                                  {
                                      id: 'origin',
                                      label: t('ui.flights.filters.origin') || 'Origin',
                                      type: 'text',
                                      placeholder: t('ui.flights.placeholders.origin') || 'Origin...',
                                  },
                                  {
                                      id: 'destination',
                                      label: t('ui.flights.filters.destination') || 'Destination',
                                      type: 'text',
                                      placeholder: t('ui.flights.placeholders.destination') || 'Destination...',
                                  },
                                  {
                                      id: 'price',
                                      label: t('ui.flights.filters.price') || 'Price',
                                      type: 'number',
                                      placeholder: t('ui.flights.placeholders.price') || 'Price...',
                                  },
                                  {
                                      id: 'seats',
                                      label: t('ui.flights.filters.seats.name') || 'Seats',
                                      type: 'select',
                                      options: [{value:'1st', label:t('ui.flights.filters.seats.1st')}, {value:'2nd', label: t('ui.flights.filters.seats.2nd')}, {value:'tourist', label: t('ui.flights.filters.seats.tourist')}],
                                      placeholder: t('ui.flights.placeholders.seats.name') || 'Seats...',
                                  },
                                  {
                                      id: 'date',
                                      label: t('ui.flights.filters.date') || 'Date',
                                      type: 'date',
                                      placeholder: t('ui.flights.placeholders.date') || 'Date...',
                                  },
                                  {
                                      id: 'state',
                                      label: t('ui.flights.filters.state.name') || 'State',
                                      type: 'select',
                                      options: [{value:'draft', label:t('ui.flights.filters.state.draft')}, {value:'waiting', label: t('ui.flights.filters.state.waiting')}, {value:'full', label: t('ui.flights.filters.state.full')}, {value:'travelling', label: t('ui.flights.filters.state.travelling')}],
                                      placeholder: t('ui.flights.placeholders.state.name') || 'State...',
                                  },
                                  {
                                      id: 'created_at',
                                      label: t('ui.flights.filters.created_at') || 'Created at',
                                      type: 'date',
                                      placeholder: t('ui.flights.placeholders.created_at') || 'Created at...',
                                  },

                              ] as FilterConfig[]
                          }
                          onFilterChange={handleFilterChange}
                          initialValues={filters}
                      />
                  </div>
                  {filterState && flights?.meta.total!=undefined && <h2>{t('ui.common.filters.results')+flights?.meta.total}</h2>}
                  <div className="w-full overflow-hidden">
                      {isLoading ? (
                          <TableSkeleton columns={4} rows={10} />
                      ) : isError ? (
                          <div className="p-4 text-center">
                              <div className="mb-4 text-red-500">{t('ui.flights.error_loading')}</div>
                              <Button onClick={() => refetch()} variant="outline">
                                  {t('ui.flights.buttons.retry')}
                              </Button>
                          </div>
                      ) : (
                          <div>
                              <Table
                                  data={
                                      flights ?? {
                                          data: [],
                                          meta: {
                                              current_page: 1,
                                              from: 0,
                                              last_page: 1,
                                              per_page: perPage,
                                              to: 0,
                                              total: 0,
                                          },
                                      }
                                  }
                                  columns={columns}
                                  onPageChange={handlePageChange}
                                  onPerPageChange={handlePerPageChange}
                                  perPageOptions={[10, 25, 50, 100]}
                                  noResultsMessage={t('ui.flights.no_results') || 'No flights found'}
                              />
                          </div>
                      )}
                  </div>
              </div>
          </div>
      </FlightLayout>
  );
}
