import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { TableSkeleton } from "@/components/stack-table/TableSkeleton";
import { UserLayout } from "@/layouts/users/UserLayout";
import { User, useDeleteUser, useUsers } from "@/hooks/users/useUsers";
import { PencilIcon, PlusIcon, TrashIcon } from "lucide-react";
import { useDebounce } from "@/hooks/use-debounce";
import { useState, useMemo } from "react";
import { Link, usePage } from "@inertiajs/react";
import { useTranslations } from "@/hooks/use-translations";
import { Table } from "@/components/stack-table/Table";
import { createTextColumn, createDateColumn, createActionsColumn } from "@/components/stack-table/columnsTable";
import { DeleteDialog } from "@/components/stack-table/DeleteDialog";
import { FiltersTable, FilterConfig } from "@/components/stack-table/FiltersTable";
import { toast } from "sonner";
import { ColumnDef, Row } from "@tanstack/react-table";
import { TicketLayout } from "@/layouts/tickets/TicketLayout";
import { Ticket, useDeleteTicket, useTickets } from "@/hooks/tickets/useTickets";
import { isEmpty } from "lodash";
interface PageProps {
    auth: {
        user: any;
        permissions: string[];
    };
}

export default function TicketsIndex() {
  const { t } = useTranslations();
  const { url } = usePage();
  const page = usePage<{ props: PageProps }>();
  const auth = page.props.auth;


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
    filters.user ? filters.user : 'null',
    filters.flight ? filters.flight : 'null',
    filters.date ? filters.date : 'null',
    filters.seats ? filters.seats : 'null',
    filters.created_at ? filters.created_at : 'null',
  ];

  const { data: tickets, isLoading, isError, refetch } = useTickets({
    search: combinedSearch,
    page: currentPage,
    perPage: perPage,
  });
  const deleteTicketMutation = useDeleteTicket();
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

  const handleDeleteTicket = async (id: string) => {
    try {
      await deleteTicketMutation.mutateAsync(id);
      refetch();
    } catch (error) {
      toast.error(t("ui.tickets.deleted_error") || "Error deleting ticket");
      console.error("Error deleting ticket:", error);
    }
  };

  const columns = useMemo(() => ([
    createTextColumn<Ticket>({
      id: "user",
      header: t("ui.tickets.columns.user") || "User",
      accessorKey: "user",
    }),
    createTextColumn<Ticket>({
      id: "flight",
      header: t("ui.tickets.columns.flight") || "Flight",
      accessorKey: "flight",
    }),
    createTextColumn<Ticket>({
      id: "seats",
      header: t("ui.tickets.columns.seats.name") || "Seats",
      format: (value) => {
            let returnedValue=t(`ui.tickets.columns.seats.${value}`);
            let aux;
            let res: string[] = [];
            if (value.includes(',')) {
                aux = value.split(', ');
                aux.map((seat) => {
                    seat = t(`ui.tickets.columns.seats.${seat}`);
                    res=[...res, seat];
                });
                aux = res.join(', ');
                returnedValue=aux;
            }
            return returnedValue;
        },
      accessorKey: "seats",
    }),
    createDateColumn<Ticket>({
      id: "date",
      header: t("ui.tickets.columns.date") || "Date",
      accessorKey: "date",
    }),
    createDateColumn<Ticket>({
      id: "created_at",
      header: t("ui.tickets.columns.created_at") || "Created At",
      accessorKey: "created_at",
    }),

    createActionsColumn<Ticket>({
      id: "actions",
      header: t("ui.tickets.columns.actions") || "Actions",
      renderActions: (ticket) => (
        <>
        {auth.permissions.includes('products.edit')&&
          <Link href={`/tickets/${ticket.id}/edit?page=${currentPage}&perPage=${perPage}`}>
            <Button variant="outline" size="icon" title={t("ui.tickets.buttons.edit") || "Edit ticket"}>
              <PencilIcon className="h-4 w-4" />
            </Button>
          </Link>
        }
          <DeleteDialog
            id={ticket.id}
            onDelete={handleDeleteTicket}
            title={t("ui.tickets.delete.title") || "Delete ticket"}
            description={t("ui.tickets.delete.description") || "Are you sure you want to delete this ticket? This action cannot be undone."}
            trigger={
              <Button variant="outline" size="icon" className="text-destructive hover:text-destructive" title={t("ui.tickets.buttons.delete") || "Delete ticket"}>
                <TrashIcon className="h-4 w-4" />
              </Button>
            }
          />
        </>
      ),
    }
    ),
  ] as ColumnDef<Ticket>[]), [t, handleDeleteTicket]);

  return (
      <TicketLayout title={t('ui.tickets.title')}>
          <div className="p-6">
              <div className="space-y-6">
                  <div className="flex items-center justify-between">
                      <h1 className="text-3xl font-bold">{t('ui.tickets.title')}</h1>
                      {auth.permissions.includes('products.create')&&
                      <Link href="/tickets/create">
                          <Button>
                              <PlusIcon className="mr-2 h-4 w-4" />
                              {t('ui.tickets.buttons.new')}
                          </Button>
                      </Link>
                      }
                  </div>
                  <div></div>

                  <div className="space-y-4">
                      <FiltersTable
                          filters={
                              [
                                  {
                                      id: 'user',
                                      label: t('ui.tickets.filters.user') || 'User',
                                      type: 'text',
                                      placeholder: t('ui.tickets.placeholders.user') || 'User...',
                                  },
                                  {
                                      id: 'flight',
                                      label: t('ui.tickets.filters.flight') || 'Flight',
                                      type: 'text',
                                      placeholder: t('ui.tickets.placeholders.flight') || 'Flight...',
                                  },
                                  {
                                      id: 'date',
                                      label: t('ui.tickets.filters.date') || 'Date',
                                      type: 'date',
                                      placeholder: t('ui.tickets.placeholders.date') || 'Date...',
                                  },
                                  {
                                      id: 'seats',
                                      label: t('ui.flights.filters.seats.name') || 'Seats',
                                      type: 'select',
                                      options: [{value:'1st', label:t('ui.flights.filters.seats.1st')}, {value:'2nd', label: t('ui.flights.filters.seats.2nd')}, {value:'tourist', label: t('ui.flights.filters.seats.tourist')}],
                                      placeholder: t('ui.flights.placeholders.seats.name') || 'Seats...',
                                  },
                                  {
                                      id: 'created_at',
                                      label: t('ui.tickets.filters.created_at') || 'Created at',
                                      type: 'date',
                                      placeholder: t('ui.tickets.placeholders.created_at') || 'Created at...',
                                  },

                              ] as FilterConfig[]
                          }
                          onFilterChange={handleFilterChange}
                          initialValues={filters}
                      />
                  </div>
                  {filterState && tickets?.meta.total!=undefined && <h2>{t('ui.common.filters.results')+tickets?.meta.total}</h2>}
                  <div className="w-full overflow-hidden">
                      {isLoading ? (
                          <TableSkeleton columns={4} rows={10} />
                      ) : isError ? (
                          <div className="p-4 text-center">
                              <div className="mb-4 text-red-500">{t('ui.tickets.error_loading')}</div>
                              <Button onClick={() => refetch()} variant="outline">
                                  {t('ui.tickets.buttons.retry')}
                              </Button>
                          </div>
                      ) : (
                          <div>
                              <Table
                                  data={
                                      tickets ?? {
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
                                  noResultsMessage={t('ui.tickets.no_results') || 'No tickets found'}
                              />
                          </div>
                      )}
                  </div>
              </div>
          </div>
      </TicketLayout>
  );
}
