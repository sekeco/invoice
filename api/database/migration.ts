import {
    mysqlTable,
    varchar,
    text,
    timestamp,
    decimal,
    boolean,
    mysqlEnum,
    int,
    datetime,
    index,
    unique,
} from "drizzle-orm/mysql-core";
import { relations } from "drizzle-orm";

// Enums
export const userRoleEnum = mysqlEnum("user_role", ["ADMIN", "MEMBER"]);

// Organizations table
export const organizations = mysqlTable("organizations", {
    id: varchar("id", { length: 255 }).primaryKey(),
    name: varchar("name", { length: 255 }).notNull(),
    email: varchar("email", { length: 255 }),
    phone: varchar("phone", { length: 50 }),
    address: text("address"),
    defaultCurrency: varchar("default_currency", { length: 3 })
        .default("USD")
        .notNull(),
    createdAt: timestamp("created_at").defaultNow().notNull(),
    updatedAt: timestamp("updated_at").defaultNow().onUpdateNow().notNull(),
});

// Users table
export const users = mysqlTable("users", {
    id: varchar("id", { length: 255 }).primaryKey(),
    email: varchar("email", { length: 255 }).unique().notNull(),
    name: varchar("name", { length: 255 }).notNull(),
    password: varchar("password", { length: 255 }).notNull(),
    createdAt: timestamp("created_at").defaultNow().notNull(),
    updatedAt: timestamp("updated_at").defaultNow().onUpdateNow().notNull(),
});

// Sessions table
export const sessions = mysqlTable("sessions", {
    id: varchar("id", { length: 255 }).primaryKey(),
    userId: varchar("user_id", { length: 255 }).notNull(),
    token: varchar("token", { length: 255 }).unique().notNull(),
    expiresAt: timestamp("expires_at").notNull(),
    createdAt: timestamp("created_at").defaultNow().notNull(),
});

// Organization Users table
export const organizationUsers = mysqlTable(
    "organization_users",
    {
        id: varchar("id", { length: 255 }).primaryKey(),
        organizationId: varchar("organization_id", { length: 255 }).notNull(),
        userId: varchar("user_id", { length: 255 }).notNull(),
        role: userRoleEnum.default("MEMBER").notNull(),
        createdAt: timestamp("created_at").defaultNow().notNull(),
        updatedAt: timestamp("updated_at").defaultNow().onUpdateNow().notNull(),
    },
    (table) => ({
        uniqueOrgUser: unique().on(table.organizationId, table.userId),
    })
);

// Invoice Statuses table
export const invoiceStatuses = mysqlTable(
    "invoice_statuses",
    {
        id: varchar("id", { length: 255 }).primaryKey(),
        name: varchar("name", { length: 255 }).notNull(),
        color: varchar("color", { length: 7 }),
        isDefault: boolean("is_default").default(false).notNull(),
        organizationId: varchar("organization_id", { length: 255 }).notNull(),
        createdAt: timestamp("created_at").defaultNow().notNull(),
        updatedAt: timestamp("updated_at").defaultNow().onUpdateNow().notNull(),
    },
    (table) => ({
        uniqueOrgStatus: unique().on(table.organizationId, table.name),
    })
);

// Invoices table
export const invoices = mysqlTable("invoices", {
    id: varchar("id", { length: 255 }).primaryKey(),
    invoiceNumber: varchar("invoice_number", { length: 255 })
        .unique()
        .notNull(),
    clientName: varchar("client_name", { length: 255 }).notNull(),
    clientEmail: varchar("client_email", { length: 255 }),
    clientAddress: text("client_address"),
    clientPhone: varchar("client_phone", { length: 50 }),
    statusId: varchar("status_id", { length: 255 }).notNull(),
    currency: varchar("currency", { length: 3 }).default("USD").notNull(),
    issueDate: timestamp("issue_date").defaultNow().notNull(),
    dueDate: timestamp("due_date").notNull(),
    notes: text("notes"),
    subtotal: decimal("subtotal", { precision: 10, scale: 2 })
        .default("0")
        .notNull(),
    taxAmount: decimal("tax_amount", { precision: 10, scale: 2 })
        .default("0")
        .notNull(),
    discountAmount: decimal("discount_amount", { precision: 10, scale: 2 })
        .default("0")
        .notNull(),
    totalAmount: decimal("total_amount", { precision: 10, scale: 2 })
        .default("0")
        .notNull(),
    paidAt: timestamp("paid_at"),
    organizationId: varchar("organization_id", { length: 255 }).notNull(),
    createdById: varchar("created_by_id", { length: 255 }).notNull(),
    createdAt: timestamp("created_at").defaultNow().notNull(),
    updatedAt: timestamp("updated_at").defaultNow().onUpdateNow().notNull(),
});

// Invoice Items table
export const invoiceItems = mysqlTable("invoice_items", {
    id: varchar("id", { length: 255 }).primaryKey(),
    description: text("description").notNull(),
    quantity: decimal("quantity", { precision: 10, scale: 2 }).notNull(),
    unitPrice: decimal("unit_price", { precision: 10, scale: 2 }).notNull(),
    totalPrice: decimal("total_price", { precision: 10, scale: 2 }).notNull(),
    invoiceId: varchar("invoice_id", { length: 255 }).notNull(),
});

// Relations
export const organizationsRelations = relations(organizations, ({ many }) => ({
    organizationUsers: many(organizationUsers),
    invoices: many(invoices),
    invoiceStatuses: many(invoiceStatuses),
}));

export const usersRelations = relations(users, ({ many }) => ({
    organizationUsers: many(organizationUsers),
    invoices: many(invoices),
    sessions: many(sessions),
}));

export const sessionsRelations = relations(sessions, ({ one }) => ({
    user: one(users, {
        fields: [sessions.userId],
        references: [users.id],
    }),
}));

export const organizationUsersRelations = relations(
    organizationUsers,
    ({ one }) => ({
        organization: one(organizations, {
            fields: [organizationUsers.organizationId],
            references: [organizations.id],
        }),
        user: one(users, {
            fields: [organizationUsers.userId],
            references: [users.id],
        }),
    })
);

export const invoiceStatusesRelations = relations(
    invoiceStatuses,
    ({ one, many }) => ({
        organization: one(organizations, {
            fields: [invoiceStatuses.organizationId],
            references: [organizations.id],
        }),
        invoices: many(invoices),
    })
);

export const invoicesRelations = relations(invoices, ({ one, many }) => ({
    organization: one(organizations, {
        fields: [invoices.organizationId],
        references: [organizations.id],
    }),
    createdBy: one(users, {
        fields: [invoices.createdById],
        references: [users.id],
    }),
    status: one(invoiceStatuses, {
        fields: [invoices.statusId],
        references: [invoiceStatuses.id],
    }),
    items: many(invoiceItems),
}));

export const invoiceItemsRelations = relations(invoiceItems, ({ one }) => ({
    invoice: one(invoices, {
        fields: [invoiceItems.invoiceId],
        references: [invoices.id],
    }),
}));
